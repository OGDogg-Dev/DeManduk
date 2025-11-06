import json
import textwrap
from pathlib import Path

DATA_PATH = Path("temp/sqlite_data.json")
OUTPUT_PATH = Path("database/seeders/SqliteContentSeeder.php")

TABLE_ORDER = [
    "users",
    "site_settings",
    "home_slides",
    "home_projects",
    "home_features",
    "home_pricing_rows",
    "home_opening_hours",
    "home_stats",
    "home_procedures",
    "home_guides",
    "contact_supports",
    "contact_alerts",
    "gallery_items",
    "events",
    "news_posts",
    "qris_steps",
    "qris_notes",
    "qris_faqs",
    "sop_steps",
    "sop_objectives",
    "sop_partners",
    "sop_documents",
]


def php_value(value: object) -> str:
    if value is None:
        return "null"
    if isinstance(value, bool):
        return "true" if value else "false"
    if isinstance(value, (int, float)):
        return repr(value)
    value = str(value)
    value = value.replace("\\", "\\\\").replace("'", "\\'")
    return f"'{value}'"


def format_row(row: dict, base_indent: str = " " * 12) -> str:
    inner_indent = base_indent + "    "
    inner = ",\n".join(
        f"{inner_indent}'{key}' => {php_value(value)}"
        for key, value in row.items()
    )
    if not inner:
        return f"{base_indent}[]"
    return f"{base_indent}[\n{inner}\n{base_indent}]"


def main() -> None:
    if not DATA_PATH.exists():
        raise SystemExit(f"Data file not found: {DATA_PATH}")

    data = json.loads(DATA_PATH.read_text(encoding="utf-8"))

    seeder_body_parts = []

    for table in TABLE_ORDER:
        rows = data.get(table, [])
        if rows:
            row_blocks = [f"{format_row(row)}," for row in rows]
            rows_str = "\n".join(row_blocks)
            table_block = (
                f"        '{table}' => [\n"
                f"{rows_str}\n"
                f"        ],"
            )
        else:
            table_block = f"        '{table}' => [],"

        seeder_body_parts.append(table_block)

    tables_array = "\n".join(seeder_body_parts)

    seeder_code = f"""<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Console\\Seeds\\WithoutModelEvents;
use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Schema;

class SqliteContentSeeder extends Seeder
{{
    use WithoutModelEvents;

    public function run(): void
    {{
        Schema::disableForeignKeyConstraints();

        $data = [
{tables_array}
        ];

        foreach ($data as $table => $rows) {{
            DB::table($table)->truncate();

            if (! empty($rows)) {{
                DB::table($table)->insert($rows);
            }}
        }}

        Schema::enableForeignKeyConstraints();
    }}
}}
"""

    OUTPUT_PATH.write_text(seeder_code, encoding="utf-8")
    print(f"Seeder written to {OUTPUT_PATH}")


if __name__ == "__main__":
    main()

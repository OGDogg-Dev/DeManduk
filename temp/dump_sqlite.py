import json
import sqlite3
from pathlib import Path

db_path = Path(__file__).resolve().parent.parent / "database" / "database.sqlite"

conn = sqlite3.connect(db_path)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

cur.execute(
    "SELECT name FROM sqlite_master WHERE type='table' "
    "AND name NOT LIKE 'sqlite_%' ORDER BY name"
)
tables = [row[0] for row in cur.fetchall()]

summary = {}
rows_data = {}

for table in tables:
    cur.execute(f"PRAGMA table_info({table})")
    columns = [row[1] for row in cur.fetchall()]
    cur.execute(f"SELECT COUNT(*) AS c FROM {table}")
    count = cur.fetchone()[0]
    summary[table] = {"columns": columns, "count": count}

    cur.execute(f"SELECT * FROM {table}")
    rows = [dict(row) for row in cur.fetchall()]
    rows_data[table] = rows

conn.close()

Path("temp").mkdir(exist_ok=True)
(Path("temp") / "sqlite_summary.json").write_text(json.dumps(summary, indent=2), encoding="utf-8")
(Path("temp") / "sqlite_data.json").write_text(json.dumps(rows_data, indent=2), encoding="utf-8")

print("Summary written to temp/sqlite_summary.json")
print("Data written to temp/sqlite_data.json")

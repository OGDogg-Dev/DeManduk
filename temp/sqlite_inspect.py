import sqlite3
from pathlib import Path

db_path = Path(__file__).resolve().parent.parent / "database" / "database.sqlite"

conn = sqlite3.connect(db_path)

cur = conn.cursor()
cur.execute(
    "SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name"
)

for (name,) in cur.fetchall():
    print(name)

conn.close()

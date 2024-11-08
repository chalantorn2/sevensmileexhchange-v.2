// เรียกใช้ dotenv เพื่อตั้งค่า environment variables
require('dotenv').config();
const { Pool } = require('pg');

// ตั้งค่าการเชื่อมต่อฐานข้อมูลด้วย environment variables
const pool = new Pool({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    database: process.env.DB_NAME,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    ssl: { rejectUnauthorized: false } // ตั้งค่าให้รับรองการเชื่อมต่อ SSL
});

// ฟังก์ชันสำหรับเรียกการเชื่อมต่อฐานข้อมูล
pool.on('connect', () => {
    console.log('Database connected successfully');
});

// ฟังก์ชันสำหรับจัดการข้อผิดพลาด
pool.on('error', (err) => {
    console.error('Unexpected error on idle client', err);
    process.exit(-1);
});

module.exports = {
    query: (text, params) => pool.query(text, params),
};

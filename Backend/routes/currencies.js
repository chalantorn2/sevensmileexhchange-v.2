const express = require('express');
const router = express.Router();
const db = require('../config');  // เรียกใช้งานฐานข้อมูลจาก config.js

// ดึงข้อมูลค่าเงินทั้งหมด
router.get('/exchange-rates', async (req, res) => {
    try {
        const result = await db.query('SELECT * FROM currencies');
        res.json(result.rows);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// เพิ่มข้อมูลค่าเงินใหม่
router.post('/add-currency', async (req, res) => {
    const { currency, country_name, denomination, buying } = req.body;
    try {
        const result = await db.query(
            'INSERT INTO currencies (currency, country_name, denomination, buying) VALUES ($1, $2, $3, $4) RETURNING *',
            [currency, country_name, denomination, buying]
        );
        res.json(result.rows[0]);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// อัปเดตข้อมูลค่าเงิน
router.put('/update-currency', async (req, res) => {
    const { id, field, value } = req.body;
    try {
        const query = `UPDATE currencies SET ${field} = $1 WHERE id = $2 RETURNING *`;
        const result = await db.query(query, [value, id]);
        res.json(result.rows[0]);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ลบข้อมูลค่าเงิน
router.delete('/delete-currency/:id', async (req, res) => {
    const { id } = req.params;
    try {
        await db.query('DELETE FROM currencies WHERE id = $1', [id]);
        res.json({ message: 'Currency deleted' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;

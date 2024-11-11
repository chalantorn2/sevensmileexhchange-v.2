// เริ่มต้นเซิร์ฟเวอร์
console.log("Starting server...");

const express = require('express');
const cors = require('cors');
const app = express();
console.log("Express and CORS loaded");

// โหลด routes ที่เกี่ยวข้องกับค่าเงิน
const currencyRoutes = require('./routes/currencies');

// ตั้งค่า Middleware
app.use(cors());
app.use(express.json());
console.log("Middleware loaded");

// ตั้งค่า API routes
app.use('/api', currencyRoutes);
console.log("Routes loaded");

// กำหนดพอร์ตและเริ่มเซิร์ฟเวอร์
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});

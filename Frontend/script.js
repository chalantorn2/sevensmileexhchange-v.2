fetch('https://fzmwpjymjgoaqypkivxm.supabase.co/rest/v1/currencies', {
    method: 'GET',
    headers: {
        apikey: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZ6bXdwaXltamdvYXF5cGtpdnhtIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzEwNTMxNDksImV4cCI6MjA0NjYyOTE0OX0.ACyOJBiuSLeFyQNA8B5n1hPMGgSKNpbmVJzbaeOc8_0',
        Authorization: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZ6bXdwaXltamdvYXF5cGtpdnhtIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzEwNTMxNDksImV4cCI6MjA0NjYyOTE0OX0.ACyOJBiuSLeFyQNA8B5n1hPMGgSKNpbmVJzbaeOc8_0',
        'Content-Type': 'application/json'
    }
})
    .then(response => response.json())
    .then(data => {
        console.log(data); // ตรวจสอบข้อมูลที่ดึงมาได้
        populateTable(data); // ฟังก์ชันนี้ใช้เพื่อแสดงข้อมูลในตาราง (ตามตัวอย่างที่เราเขียนไว้แล้ว)
    })
    .catch(error => console.error('Error fetching data:', error));
// ดึงข้อมูลจาก API
fetch('http://localhost:5000/api/exchange-rates')
    .then(response => response.json())
    .then(data => {
        // ตรวจสอบข้อมูลใน console (สำหรับการดีบัก)
        console.log(data);

        // หาตารางที่ต้องการเพิ่มข้อมูล
        const tableBody = document.querySelector('#exchangeTable tbody');
        
        // ลบข้อมูลเดิมในตารางก่อน (หากมี)
        tableBody.innerHTML = '';

        // เพิ่มข้อมูลจาก API ลงในตาราง
        data.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="path/to/flags/${item.currency_image}" alt="${item.country_name} flag" width="50" /></td>
                <td>${item.country_name}</td>
                <td>${item.denomination}</td>
                <td>${item.buying}</td>
                <td>${item.order}</td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

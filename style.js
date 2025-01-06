document.getElementById('login').addEventListener('submit', function(event) {
    let username = document.querySelector('input[name="username"]').value;
    let password = document.querySelector('input[name="password"]').value;
    
    // ตรวจสอบข้อมูลพื้นฐานก่อน
    if (username === '' || password === '') {
        event.preventDefault();  // หยุดการส่งฟอร์ม
        document.querySelector('.form__message').textContent = 'Username and password are required';
        document.querySelector('.form__message').classList.add('form__message--error');
    }
});

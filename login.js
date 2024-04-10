const mysql = require('mysql');

function addStudent(name, age) {
    const connection = mysql.createConnection({
        host: 'localhost',
        user: 'your_username',
        password: 'your_password',
        database: 'your_database'
    });

    connection.connect((err) => {
        if (err) throw err;
        console.log('Connected!');
    });

    const sql = 'INSERT INTO STUDENTS (NAME, AGE) VALUES (?, ?)';
    const values = [name, age];

    connection.query(sql, values, (err, result) => {
        if (err) throw err;
        console.log('1 record inserted');
    });

    connection.end();
}
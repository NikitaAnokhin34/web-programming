// skript.js
document.addEventListener('DOMContentLoaded', function () {
    let tableCreated = false;

    document.getElementById('createTable').addEventListener('click', function () {
        if (tableCreated) {
            alert('Таблица уже создана!');
            return;
        }

        // Создаем таблицу
        const table = document.createElement('table');
        table.id = 'myTable';

        // Создаем заголовок таблицы
        const header = table.createTHead();
        const headerRow = header.insertRow(0);
        const headerCell1 = headerRow.insertCell(0);
        const headerCell2 = headerRow.insertCell(1);
        headerCell1.innerHTML = '<b>№</b>';
        headerCell2.innerHTML = '<b>Содержимое</b>';

        document.body.appendChild(table);
        tableCreated = true;

        // Активируем остальные кнопки
        document.getElementById('addTable').removeAttribute('disabled');
        document.getElementById('removeTable').removeAttribute('disabled');
        document.getElementById('vvodnumber').removeAttribute('disabled');
    });

    document.getElementById('addTable').addEventListener('click', function () {
        if (!tableCreated) {
            alert('Сначала создайте таблицу!');
            return;
        }

        // Добавляем строку
        const table = document.getElementById('myTable');
        const row = table.insertRow(-1);
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        cell1.innerHTML = table.rows.length - 1;
        cell2.innerHTML = 'Содержимое';
    });

    document.getElementById('removeTable').addEventListener('click', function () {
        if (!tableCreated) {
            alert('Сначала создайте таблицу!');
            return;
        }

        const table = document.getElementById('myTable');
        const rowNumberInput = document.getElementById('vvodnumber');
        const rowNumber = parseInt(rowNumberInput.value);

        if (isNaN(rowNumber) || rowNumber <= 0 || rowNumber >= table.rows.length) {
            alert('Некорректный номер строки!');
            return;
        }

        table.deleteRow(rowNumber);
        // Перенумеровываем строки после удаления
        for (let i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[0].innerHTML = i;
        }

        rowNumberInput.value = ''; // Очищаем поле ввода
    });
});

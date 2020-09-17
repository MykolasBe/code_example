<table>
    <thead>
    <tr>
        <?php foreach ($data['headers'] ?? [] as $table_head): ?>
            <th><?php print $table_head; ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['data'] ?? [] as $table_row): ?>
        <tr>
            <?php foreach ($table_row ?? [] as $row_data): ?>
                <td><?php print $row_data; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


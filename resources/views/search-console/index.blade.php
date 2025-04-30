<h2>Data Search Console</h2>
<table>
    <tr>
        <th>Query</th>
        <th>Clicks</th>
        <th>Impressions</th>
    </tr>
    @foreach ($data->getRows() as $row)
        <tr>
            <td>{{ $row['keys'][0] }}</td>
            <td>{{ $row['clicks'] }}</td>
            <td>{{ $row['impressions'] }}</td>
        </tr>
    @endforeach
</table>

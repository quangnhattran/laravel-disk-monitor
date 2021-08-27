<h1>Disk Metrics</h1>

<table>
    <thead>
        <tr>
            <th>Disk</th>
            <th>Files Count</th>
            <th>Recorded at</th>
        </tr>
        @foreach($entries as $entry)
            <tr>
                <td>{{$entry->disk_name}}</td>
                <td>{{$entry->files_count}}</td>
                <td>{{$entry->created_at->format('Y-m-d H:i:s')}}</td>
            </tr>
        @endforeach
    </thead>
</table>

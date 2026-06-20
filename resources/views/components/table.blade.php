<div class="overflow-x-auto rounded-lg border border-slate-200">
    <table id="{{ $id }}" class="min-w-full divide-y divide-slate-200">
        <thead class="bg-primary-600">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200 {{ $striped ? 'striped' : '' }}">
            {{ $slot }}
        </tbody>
    </table>
</div>

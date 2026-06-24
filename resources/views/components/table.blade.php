<div class="overflow-hidden rounded-2xl border-2 border-slate-200 shadow-lg bg-white">
    <div class="overflow-x-auto">
        <table id="{{ $id }}" class="min-w-full divide-y divide-slate-200">
            <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                <tr>
                    @foreach ($headers as $header)
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider
                                             border-b-2 border-slate-200 first:pl-8 last:pr-8">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

@extends('layouts.dash')

@section('content')
<div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
	<h2 class="mb-4 text-2xl font-semibold leadi">Invoices</h2>
	<div class="overflow-x-auto">
		<table class="min-w-full text-xs">
			<colgroup>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col class="w-24">
			</colgroup>
			<thead class="dark:bg-gray-700">
				<tr class="text-left">
					<th class="p-3">Invoice #</th>
					<th class="p-3">Client</th>
					<th class="p-3">Issued</th>
					<th class="p-3">Due</th>
					<th class="p-3 text-right">Amount</th>
					<th class="p-3">Status</th>
				</tr>
			</thead>
			<tbody>
				<tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
					<td class="p-3">
						<p>97412378923</p>
					</td>
					<td class="p-3">
						<p>Microsoft Corporation</p>
					</td>
					<td class="p-3">
						<p>14 Jan 2022</p>
						<p class="dark:text-gray-400">Friday</p>
					</td>
					<td class="p-3">
						<p>01 Feb 2022</p>
						<p class="dark:text-gray-400">Tuesday</p>
					</td>
					<td class="p-3 text-right">
						<p>$15,792</p>
					</td>
					<td class="p-3 text-right">
						<span class="px-3 py-1 font-semibold rounded-md dark:bg-blue-400 dark:text-gray-900">
							<span>Pending</span>
						</span>
					</td>
				</tr>
				<tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
					<td class="p-3">
						<p>97412378923</p>
					</td>
					<td class="p-3">
						<p>Tesla Inc.</p>
					</td>
					<td class="p-3">
						<p>14 Jan 2022</p>
						<p class="dark:text-gray-400">Friday</p>
					</td>
					<td class="p-3">
						<p>01 Feb 2022</p>
						<p class="dark:text-gray-400">Tuesday</p>
					</td>
					<td class="p-3 text-right">
						<p>$275</p>
					</td>
					<td class="p-3 text-right">
						<span class="px-3 py-1 font-semibold rounded-md dark:bg-blue-400 dark:text-gray-900">
							<span>Pending</span>
						</span>
					</td>
				</tr>
				<tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
					<td class="p-3">
						<p>97412378923</p>
					</td>
					<td class="p-3">
						<p>Coca Cola co.</p>
					</td>
					<td class="p-3">
						<p>14 Jan 2022</p>
						<p class="dark:text-gray-400">Friday</p>
					</td>
					<td class="p-3">
						<p>01 Feb 2022</p>
						<p class="dark:text-gray-400">Tuesday</p>
					</td>
					<td class="p-3 text-right">
						<p>$8,950,500</p>
					</td>
					<td class="p-3 text-right">
						<span class="px-3 py-1 font-semibold rounded-md dark:bg-blue-400 dark:text-gray-900">
							<span>Pending</span>
						</span>
					</td>
				</tr>
				<tr class="border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
					<td class="p-3">
						<p>97412378923</p>
					</td>
					<td class="p-3">
						<p>Nvidia Corporation</p>
					</td>
					<td class="p-3">
						<p>14 Jan 2022</p>
						<p class="dark:text-gray-400">Friday</p>
					</td>
					<td class="p-3">
						<p>01 Feb 2022</p>
						<p class="dark:text-gray-400">Tuesday</p>
					</td>
					<td class="p-3 text-right">
						<p>$98,218</p>
					</td>
					<td class="p-3 text-right">
						<span class="px-3 py-1 font-semibold rounded-md dark:bg-blue-400 dark:text-gray-900">
							<span>Pending</span>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection
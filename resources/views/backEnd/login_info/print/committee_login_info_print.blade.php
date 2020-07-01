<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			background: rgb(238, 174, 202);
			background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
		}

		.container {
			max-width: 980px;
			margin: 0 auto;
			background: #eee;
			padding: 10px;
		}

		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
		}

		#table td,
		#table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#table tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		#table tr:hover {
			background-color: #ddd;
		}

		#table th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #ccc;
			color: #000;
			font-weight: bold;
		}

		#table th,
		#table td {
			text-align: center;
		}

		#table td {
			padding: 5px 10px;
		}

		.header {
			text-align: center;
		}

		.address {
			font-size: 14px;
		}
		.search_info {
			font-size: 12px;
		}

		.text-danger {
			color: red;
		}
		.logo{
			width: 80px;
			height: 80px;
		}
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>

<body>

	<div class="container">
		<div class="header">
			<h2>
				{{ $school->user->name??'' }} <br>
				<img class="logo" src="{{ Storage::url($school->logo??'public/images/default/user.png') }}" alt="Logo"><br>
				<span class="address">{{ $school->address }}</span> <br>
			</h2>
			<h3>Committee Login Information</h3>
			<br>
		</div>
		<table id="table">
			<thead>
				<tr>
					<th class="text-center">ক্রমিক</th>
					<th class="text-center">নাম</th>
					<th class="text-center">জাতীয় পরিচয়পত্র</th>
					<th class="text-center">ইমেইল</th>
					<th class="text-center">পাসওয়ার্ড</th>
				</tr>
			</thead>
			<tbody>
				@php
					$i = 1;
				@endphp
				@foreach ($committees as $committee)
					<tr>
						<td class="text-center">{{ $i++ }}</td>
						<td style="text-align:left;">{{ $committee->user->name??'' }}</td>
						<td class="text-center">{{ $committee->nid }}</td>
						<td class="text-center">{{ $committee->user->email??'' }}</td>
						<td class="text-center">{{ $committee->user->real_password??'' }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

</body>

</html>

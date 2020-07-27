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
			padding: 5px;
		}
		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
			font-size: 10px;
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
			padding-top: 8px;
			padding-bottom: 8px;
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
			padding: 5px 5px;
		}
		.header {
			text-align: center;
		}
		.address {
			font-size: 10px;
		}
		.search_info {
			font-size: 10px;
		}
		.text-danger {
			color: red;
		}
		.logo{
			width: 60px;
			height: 60px;
		}
		h2{
			font-size: 16px;
		}
		h3{
			font-size: 12px;
		}
		.box{
			position: relative;
			padding: 5px;
			margin-bottom: 10px; 
			border: 1px solid #ddd;
		}
		@media print
        {
            .box{
                page-break-inside: avoid;
            }
        }
		.powered{
			padding: 10px 10px;
			font-size: 10px;
		}
		.photo{
			position: absolute;
			width: 80px;
			height: 80px;
			right: 3%;
			top: 10%;
		}
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>

<body>

	<div class="container">
		@foreach ($employees as $employee)
			<div class="box">
				<div class="header">
					<h2>
						{{ $school->user->name??'' }} <br>
						<img class="logo" src="{{ Storage::url($school->logo??'public/images/default/user.png') }}" alt="Logo"><br>
						<span class="address">{{ $school->address }}</span> <br>
						<span class="address">Website: {{ $school->website }}</span> <br>
						@if ($photo_status==1)
							<img class="photo" src="{{ Storage::url($employee->photo??'public/images/user.png') }}" alt="Photo" />
						@endif
					</h2>
					<h3>Employee Login Information</h3>
					<br>
				</div>
				<table id="table">
					<thead>
						<tr>
							<th class="text-center">Name</th>
							<th class="text-center">ID No.</th>
							<th class="text-center">Designation</th>
							<th class="text-center">Email</th>
							<th class="text-center">Password</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align:left;">{{ $employee->user->name??'' }}</td>
							<td class="text-center">{{ $employee->staff_id }}</td>
							<td class="text-center">{{ $employee->designation->name??'' }}</td>
							<td class="text-center">{{ $employee->user->email??'' }}</td>
							<td class="text-center">{{ $employee->user->real_password??'' }}</td>
						</tr>
					</tbody>
				</table>
				<div class="powered">
					<center>
						Powered by Ehsan Software
					</center>
				</div>
			</div>
		@endforeach
	</div>

</body>

</html>

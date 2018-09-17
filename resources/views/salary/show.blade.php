<h2>Salario: </h2>
<p>{{ $salary->date }} || ${{ $salary->amount, 1 }}</p>

<h3>Salario pertenece a:</h3>

<ul>
    @foreach($salary->employees as $employee)
    <li>{{ $employee->firstname }} 
    	{{ $employee->lastname }} 
    	{{ $employee->email }} 
    	{{ $employee->ci }} 
    	{{ $employee->phonenumber }}</li>
    @endforeach
</ul>
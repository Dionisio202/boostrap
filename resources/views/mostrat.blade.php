@extends('template');
@section('title','InicioEdison')
@section('content')

<form method="GET" action="{{ url('prueba') }}">
    @csrf
    <label for="cedula">Cédula:</label>
    <input type="text" name="cedula" id="cedula" required>
    <label for="tipo_transaccion">Tipo de Transacción:</label>
    <select name="trann" id="trann">
        <option value=" "></option>
        <option value="deposito">Depósito</option>
        <option value="retiro">Retiro</option>
    </select>
    <button type="submit">Buscar</button>


</form>
@if(isset($trann))
                    {{$trann}}
                    @endif
@if(isset($arrays))
<?php
    $deposito = 0;
    $retiro = 0;

    ?>
    <table>
        <thead>
            <th>Transacción</th>
            <th>Tipo</th>
            <th>Monto</th>
            <th>Cuenta</th>
        </thead>
        <tbody>
            @foreach($arrays as $datos)
                <tr>
                    @if(strtolower($trann) == strtolower($datos['tipo']))   
                 <td>{{$datos['id_tran']}}</td>
                    <td>{{$datos['tipo']}}</td>
                    <td>{{$datos['monto']}}</td>
                    <td>{{$datos['id_cue']}}</td>
                    @if(strtolower($datos['tipo'])=='deposito')
                    <?php $deposito += $datos['monto']; ?>
                    @endif
                    @if(strtolower($datos['tipo'])=='retiro')
                    <?php $retiro += $datos['monto']; ?>
                    @endif
                @elseif($trann=='')
                    <td>{{$datos['id_tran']}}</td>
                    <td>{{$datos['tipo']}}</td>
                    <td>{{$datos['monto']}}</td>
                    <td>{{$datos['id_cue']}}</td>
                    @if(strtolower($datos['tipo'])=='deposito')
                    <?php $deposito += $datos['monto']; ?>
                    @endif
                    @if(strtolower($datos['tipo'])=='retiro')
                    <?php $retiro += $datos['monto']; ?>
                    @endif
                @endif
                  
                </tr>
            @endforeach
        </tbody>
    </table>
    <?php
    $total=$deposito-$retiro;
    echo "<tr>";
    echo "Su total es  : ".$total;
    echo "</tr>";
    ?>
@endif

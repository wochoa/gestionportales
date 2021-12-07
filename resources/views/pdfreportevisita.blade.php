<style>
    .page-break {
        page-break-after: always;
    }
    .table{
        font-size: 12px
    }
    .center {
  margin: auto;
  width: 50%;
  /* border: 3px solid green; */
  padding: 10px;
  font-size: 15px;
  text-align: center
}
</style>


    <h2 class="center">Registro de visitas</h2>



    <table class="table" border="1" cellspacing='0'>
        <thead>
            <tr>
                <th>N</th>
                <th>DNI</th>
                <th>NOMBRE</th>
                <th>FECHA INGRESO</th>
                <th>OFICINA</th>
                <th>ESTADO</th>
                <th>ASUNTO</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($consulta as $key)
               <tr>
                   <td>{{ $key->idregvisita }}</td>
                   <td>{{ $key->dni }}</td>
                   <td>{{ $key->nombre }}</td>
                   <td>{{ $key->fechaingreso }}</td>
                   <td>{{ $key->nom_oficina }}</td>
                   <td>INGRESADO</td>
                   <td>{{ $key->motivo }}</td>
                </tr> 
            @empty
                
            @endforelse
        </tbody>
    </table>
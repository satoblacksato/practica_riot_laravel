<table class="table">
                       <thead>
                           <tr>
                               <th>Nombre</th>
                               <th>Email</th>
                               <th>Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($users as $user)
                           <tr>
                               <td>{{$user->name}}</td>
                               <td>{{$user->email}}</td>
                               <td><button class="btn btn-warning btn-xs" data-action="guardar" data-id="{{$user->id}}">Editar</button>
                               <button class="btn btn-success btn-xs" data-action="view" data-id="{{$user->id}}">Ver</button></td>
                           </tr>
                           @endforeach
                       </tbody>
</table>
                   {!! $users->render(); !!}
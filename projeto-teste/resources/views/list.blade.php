<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Projeto Teste</title>

 <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
 <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body> 

 <div id="main" class="container-fluid" style="margin-top: 50px">
 
 	<div id="top" class="row">
		<div class="col-sm-3">
			<h2>Usuários</h2>
		</div>
		<div class="col-sm-6">
        <form id="form_search" method="post" action="{{action('UsersController@list')}}">
			<div class="input-group h2"> 
                @csrf
                <input name="search" class="form-control" id="search" type="text" placeholder="Pesquisar Usuarios">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>                 
			</div>
        </form>    
			
		</div>
		<div class="col-sm-3">
			<a href="#" data-toggle="modal" data-target="#create-modal" id="btnNew" class="btn btn-primary pull-right h2">Novo Usuário</a>
		</div>
	</div> <!-- /#top -->
 
 
 	<hr />
 	<div id="list" class="row">    
	
	<div class="table-responsive col-md-12">
		<table class="table table-striped" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Email</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
					<th class="actions">Ações</th>
				</tr>
			</thead>
			<tbody>
                @foreach($Model AS $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->nome}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->cpf}}</td>
                        <td><span class="date">{{$user->data_nascimento}}</span></td>
                        <td class="actions">
                            <a class="btn btn-success btn-xs btnView" id="{{$user->id}}" href="#">Visualizar</a>
                            <a class="btn btn-warning btn-xs btnEdit" id="{{$user->id}}" href="#">Editar</a>
                            <a class="btn btn-danger btn-xs btnDelete" id="{{$user->id}}" href="#">Excluir</a>
                        </td>
                    </tr>
                @endforeach    				
			</tbody>
		</table>
	</div>
	
	</div> <!-- /#list -->
	
	<div id="bottom" class="row">
		<div class="col-md-12">
			<ul class="pagination">
                {{ $Model->links() }}
			</ul><!-- /.pagination -->
		</div>
	</div> <!-- /#bottom -->
 </div> <!-- /#main -->


<!-- Create -->

<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Novo Usuário</h4>
      </div>
      <div class="modal-body">
        <form id="form_create">
            <input type="hidden" id="id" class="form-control" />
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="row">    
                <div class="form-group col-md-6">
                    <label for="cpf">Cpf</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf">
                </div>

                <div class="form-group col-md-6">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento">
                </div>
            </div>

            <div class="row">    
                <div class="form-group col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                </div>

                <div class="form-group col-md-6">
                    <label for="senha_aux">Confirmação de senha</label>
                    <input type="password" class="form-control" id="senha_aux" placeholder="Confirme a senha">
                </div>
            </div>
        </form>
        <div class="row">    
                <div class="form-group col-md-6">
                    <label for="senha">Foto</label>
                    <input type="file" class="form-control" id="file" name="file" >
                </div>

                <div class="form-group col-md-6" id="divImg">
                    
                </div>
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnCreate">Enviar</button>	
      </div>
    </div>
  </div>
</div>



 <script src="{{asset('js/jquery.min.js')}}"></script> 
 <script src="{{asset('js/bootstrap.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
 <script src="{{asset('js/list.js')}}"></script>
</body>
</html>
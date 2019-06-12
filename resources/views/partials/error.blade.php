<?php
if(is_object($errors) ){
if($errors->any()){
    ?>
<div class="alert alert-danger">
    <p>Por Favor corrige los errores:</p>
    <ul>
        @foreach($erros->all() as $error)
            <li>{{$error}}</li>
            @endforach
    </ul>
</div>
<?php
}
}
?>
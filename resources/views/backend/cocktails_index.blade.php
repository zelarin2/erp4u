@extends('admin.admin_master')
@section('admin')
<br><br><br><br><br>
@foreach ($drink as $drin)
<div class="recipe-img-container">
    <h1 class="title"> {{ $drin['strDrink'] }}  </h1>
    <img class="recipe-img" src=" {{ $drin['strDrinkThumb'] }}" alt="Photo of the drink" height="150" width="150"/>
</div>

<div class="recipe-container">
    <div class="ingredients">
        <h2> Ingredients</h2>
        @foreach ($ingredients as $ingredient)
        <ul>
            <li>{{ $ingredient['ingredient'] }}</li>
        </ul>
        <p>{{ $ingredient['measurements'] }} </p>
        @endforeach
    </div>
<div class="ingredients">
    <h3>Instructions</h3>
        <p>{{ $drin['strInstructions'] }}</p>
    </div>
</div>
@endforeach

@endsection
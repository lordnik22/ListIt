@extends('layouts.loggedIn')

@section('title', 'Quittung')

@section('content')
<div class="container">
    <div class="row">
        <div class="row">
        <div class="col s6">
            
        </div>
        <div class="col s6">
            <div class="col s12">
                <div class="col s6">
                    <input type="number" name=""/>
                    <button>
                        Reset
                    </button>
                </div>
                <div class="col s6">
                     <input type="number" name=""/>
                    <button>
                        Reset
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>auswahl</th>
                            <th>täglich</th>
                            <th>wöchentlich</th>
                            <th>monatlich</th>
                            <th>jährlich</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>alle Jahre</td>
                        </tr>
                        <tr>
                            <td>[erstes Jahr]</td>
                        </tr>
                        <tr>
                            <td>[zweites jahr]</td>
                        </tr>
                    </tbody>
                    <tfood></tfood>
                </table>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col s6">
                
            </div>
        </div>
        
        
    </div>
</div>
@endsection



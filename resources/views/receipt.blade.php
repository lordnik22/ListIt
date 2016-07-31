@extends('layouts.loggedIn')

@section('title', 'Quittung')

@section('content')

    @unless (Auth::check())
        You are not signed in.
    @endunless
    <div class="container">
        <h1>Quittung</h1>
        <a class="btn" href="/receipt/{{ $receipt["ID"] }}/product/new">Produkt hinzufügen</a>
        <div class="productBlock">
            <table>
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Gesamtpreis</th>
                        <th>Anzahl</th>
                        <th>Löschen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receipt["Receipt_Products"] as $receipt_product)                
                        <tr>
                            <td>{{ $receipt_product["Product"]['Name'] }}</td>
                            <td>{{ number_format($receipt_product["TotalPrice"], 2) }}</td>
                            <td>{{ $receipt_product["Quantity"] }}</td>
                            <td>
                                <form action="/receipt/{{ $receipt["ID"] }}/receiptproduct/{{ $receipt_product["ID"] }}" method="POST">
                                    <a class="btn" href="/receipt/{{ $receipt["ID"] }}/receiptproduct/{{ $receipt_product["ID"] }}/update">Bearbeiten</a>                                                      
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn" type="submit" name="action">
                                        Löschen
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Kein Produkt</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
@endsection
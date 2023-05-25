@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingresos</h5>
                    <form id="ingresos-form">
                        <div class="form-group">
                            <label for="category1">Categoría</label>
                            <select class="form-control" id="category1" name="category_id" required>
                                @foreach ($incomeCategories as $incomeCategory)
                                <option value="{{ $incomeCategory->id }}">{{ $incomeCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description1" name="description">Descripción</label>
                            <input type="text" class="form-control" name="description" id="description1" required>
                        </div>
                        <div class="form-group">
                            <label for="amount1">Monto</label>
                            <input type="number" class="form-control" name="amount" id="amount1" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Ingresos existentes</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="income-body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Egresos</h5>
                    <form id="egresos-form">
                        <div class="form-group">
                            <label for="category2">Categoría</label>
                            <select class="form-control" id="category2" name="category_id" required>
                                @foreach ($expenseCategories as $expenseCategory)
                                <option value="{{ $expenseCategory->id }}">{{ $expenseCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description2">Descripción</label>
                            <input type="text" class="form-control" name="description" id="description2" required>
                        </div>
                        <div class="form-group">
                            <label for="amount2">Monto</label>
                            <input type="number" class="form-control" name="amount" id="amount2" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Egresos existentes</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="expense-body">
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h1>Totales</h1>
                    </div>
                    <div class="card-body">
                        <h1></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('js/transactions.js') }}"></script>

@endsection
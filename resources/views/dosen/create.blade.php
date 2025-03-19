@extends('layouts.index')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Manage Data Dosen</h3>
                <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <div class="d-flex align-items-center">
                  <h4 class="card-title">Add Data Dosen</h4>
                </div>
              </div>
              <div class="card-body">

              <div class="row">
                <form method="POST" action="{{ route('dosenStore') }}">
                  @csrf
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" name="nik" id="nik" placeholder="e.g. 720001" required autofocues maxlength="7"/>
                  </div>

                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="e.g. John Doe" required/>
                  </div>

                  <div class="form-group">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" name="birth_date" id="birth_date" required/>
                  </div>

                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="e.g. johndoe@email.com" required/>
                  </div>

                  <div class="card-action">
                      <input type="submit" class="btn btn-success">
                      <input type="reset" value="Cancel" class="btn btn-danger">
                    </div>
                  </div>
              </form>

            </div>
          </div>
        </div>
@endsection

@section('ExtraCss')

@endsection

@section('ExtraJS')

@endsection
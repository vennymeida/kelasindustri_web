@extends('layouts.appERROR')
<section class="section">
    <div class="container mt-5">
        <div class="page-error">
            <div class="page-inner">
                <h1>403</h1>
                <div class="page-description">
                    You do not have access to this page.
                </div>
                <div class="page-search">
                    
                    <div class="mt-3">
                        <a href="{{ route('welcome') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-footer mt-5">
            Copyright &copy; Hummantech 2023
        </div>
    </div>
</section>

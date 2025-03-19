@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<div class="contact-page">
    <div class="container">
        <h1 class="text-center mb-5">Contact Us</h1>

        <div class="row">
         
            <div class="col-md-4">
                <div class="contact-card">
                    <h3>Get In Touch</h3>
                    <p>
                        We're here to answer your questions and support you in finding or providing services. 
                        Whether you need assistance with booking, technical support, or general inquiries, 
                        our team is ready to help.
                    </p>
                    <div class="mb-4">
                        <h5>Address</h5>
                        <p><i class="fas fa-map-marker-alt me-2"></i>123 Service Lane, Tech City, TX 75001, USA</p>
                    </div>
                    <div class="mb-4">
                        <h5>Phone</h5>
                        <p><i class="fas fa-phone-alt me-2"></i>+1 (123) 456-7890</p>
                    </div>
                    <div class="mb-4">
                        <h5>Email</h5>
                        <p><i class="fas fa-envelope me-2"></i>support@platformname.com</p>
                    </div>
                    <div class="mb-4">
                        <h5>Working Hours</h5>
                        <p><i class="fas fa-clock me-2"></i>Monday - Friday: 9:00 AM - 6:00 PM</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <h3>Our Location</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.123456789012!2d-96.7890123456789!3d32.98765432109876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c123456789abc%3A0x1234567890abcdef!2sTech%20City%2C%20TX%2C%20USA!5e0!3m2!1sen!2sus!4v1697212345678"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <h3>Send Us a Message</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-control" 
                                value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" 
                                {{ auth()->check() ? 'readonly' : '' }} 
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" 
                                {{ auth()->check() ? 'readonly' : '' }} 
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
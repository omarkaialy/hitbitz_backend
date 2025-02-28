<x-mail::message>
    # Reset Password Request

    Hello Dear,
    Your reset password code is {{$code}}
    ! Attention
    If you don't send a reset password request please just skip this mail

    Regards,<br>
    {{ config('app.name') }}
</x-mail::message>


<!DOCTYPE html>
<html lang="en">
<body>
    <p></p>
    <h1>Central Mindanao University Alumni System </h1>
    <h3>Dear {{$email}},</h3>
    <p></p>
    <p>
        Hello there!
    </p>
    <p></p>
    <p></p>
    <p>
        There's new survey!
    </p>
    <p>
        {{ config('app.name') }} wants you to take this new survey if you have time to spent.
    </p>
    <p>
        If you are interested, you can redirect here
    </p>
    <p>
    @component('mail::button', ['url' => env('APP_URL')])
       <h2> Visit site </h2>
    @endcomponent
    </p>
    <p>Thanks,</p>
    <p>
    {{ config('app.name') }}
    </p>
</body>
</html>
<?php

use App\Mail\ResetPasswordEmail;

test('reset email displays the account and code with reset instructions', function () {
    $mail = new ResetPasswordEmail('explorer@example.com', '123456');

    $mail->assertSeeInHtml('explorer@example.com');
    $mail->assertSeeInHtml('123456');
    $mail->assertSeeInHtml('enter and confirm your new password');
    $mail->assertSeeInHtml('Never share it with anyone.');
});

test('reset email escapes supplied values', function () {
    $mail = new ResetPasswordEmail('<script>alert("email")</script>', '<b>123456</b>');

    $mail->assertSeeInHtml('&lt;script&gt;', false);
    $mail->assertSeeInHtml('&lt;b&gt;123456&lt;/b&gt;', false);
    $mail->assertDontSeeInHtml('<script>', false);
    $mail->assertDontSeeInHtml('<b>123456</b>', false);
});

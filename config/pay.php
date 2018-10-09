<?php
return [
    'alipay' => [
        'app_id' => '2016080400167741',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzS9HOXN1G4K7w4RQDbzjS6Sc/+a0vtVXVW5nYcRli5w0GYWchYNzqynDvsSEC+pbjKaQ03IZT8IxgDGLUFMU3bJFs0rkHuvZ9cfE4yky+8abEmDElQl51f97W6JMDnze6Ggu3slJLHwWRp7C0VI6am3aUtSIknKQp7I7QO2h6KZjBLeaNNoW+Dea7S8cL3HXe/xqgk7fEijCVgwLkf0eiXljvueeOdNwnPukSwkq3sB/2KVR4AC+9VHYOR9xNw+ajyN/u1pnVW7gYIoTENin2CXChGBQNHZO/VRRP1Zwtnz7/e7DVeRutfIGXQ6r5E5MI0RqqfkLmYmh8ZQQ3GQ41QIDAQAB',
        'private_key' => 'MIIEpAIBAAKCAQEAwnpywwahp4SYY8ZilzYoStWBmmB4Ydz2lV/8YFGQkylqekMjFo2Srgc3tnjgVT2nrLWO2MklSAx7DStbKwzp35yOlCthA9TS8W1zqPf5+hCFQKy5WeZ9S0KtBykG4//L2F6VLr7jozUI1w6IfHJx0+GuZriLkzLCB+xb8RIK2YitjNQwFk+hyrrwFoqbQsAVlWO3SkeT3gOY+YV+vJKmfH6E7htpJL8dpqXEBelggSsPwS4d0kbG1Xpnb7femvGvaxpu3u9DUMltPpEUiccI2sTtBidJoSI1rhXfetGJnDpIswKSteBoOoMRDG6WM8cGtt3H6FN5vwXMG1bWDQ136wIDAQABAoIBAQCK0VSxmT4ykRclwSoGvYWtRRGp3EqRsGPi5A0Fw7LrGJkEhH+7TXrx9fzypv2aWtQhF8fLPmj6MM507Am7hRA7qUiswvoQ/g1Ef9gbOEabFMfJDoGPhlLRMdrITaS5gpFC9OCP6XobuXOB7sHF8vsFPwZ6FCis/YI6naBTR4mvE/18tJR9erUIA8bdivVhPp1R2siTYaWIoydmjm015/lEEQ4Z8D55/1uUZXa8j0j1Rrzgv/aSRniSlasbmqMSd4fvcrvzGGg/IJNS4Pwmd0f+CVQ3tl+UP9AX3NQrcOiioZDNW2zxroDKimpt9HQJbVMTTGCWmICSFlFcfcXgNnGBAoGBAO3XGqa9mergj/CTPlJsFzqgHtKjx6E7d9nKyNdrH1oqRGf/Hf7Bx/RAiCPK3D4c24PYvSFEhj07gw8R594C7dwJEasFti4sGipM+DFFeTUlAjzo2iNyEGjOUiyQlytwsY6ZRnK2eFuqypMH6rhVCghonppfXUlu6fBkGIGhgsMRAoGBANFTx2h0+UvQv+XfcZGOEsmTOX9KDCVzSEK688uFm2eS2sWC+Sqs4H9Ln5yV/e9BIrn9FCfy4HWAO8j1yHrBENZBjqVNaVpcbuRy63ufQkF6yE0foR81ZiOwvYab1cjGgEfXmtcOHo1EYXQZfdYLj5dmFnEXnGE+fmMFxDzr7FM7AoGBANZGyXgXsafukT/JKIjRYUwsHhjf/WbBUQUisTeDB0gQdHjNW5S9uQvRZ9X3Wd2L2ik7B4oFVnusNjNJioB2Wx21/fj6uFt42Enr9l9NnBnJMe72SjFM/oOt/lKwIcG9UfqLFPEce+r6QG+e3lUcKGHS/7FM4ZrbFmDBjWKcxFZBAoGATjwPtTyyx+E3N4Txf0MoRmpd/PMB4yVZBoe1AoXm9Sjv1w4Cbi66oRj0iKOOitM/VV//Hocp2QCaV5t02Fw8HLfXxnROQdV2JK/GzydQrgRjxF9j6rQcfo5Z52tq1WVLII62clX2mTnLaob0fwFHI4CmNpJqgfXHat8G3vYWF20CgYA8CCz53Mh0UprTknmPKDzUVBH3cWEFI+/gPxdTpHNV4GupKtbVUGiReSoSr1YmAmS6y4iBe5CrenaTs1GucaXRl51x0B6MdeFblJ+ag621Ig67JYmXD92uvS2XTT/YW02XEsG5PjnocCJJBlcuCG7XBNinM6EiHyyxhSTfbhTobw==',
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],
    'wechat' => [
        'app_id' => '',
        'mch_id' => '',
        'key' => '',
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ]
];
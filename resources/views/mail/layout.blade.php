<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #eee;
    ">

        <section style="
            max-width: 800px;
            padding: 30px 20px;
            margin: 50px auto;
            background-color: #fff;
            direction: ltr;
        ">
    
            <header style="
                display: flex;
                flex-direction: column;
                margin-bottom: 50px;
            ">
                <img src="https://lh3.google.com/u/0/d/1AmUtySdOnyLyRANsHGrf5x3kG8VU3B7u=w1675-h931-iv1" style="max-height: 50px">
                <h1 style="
                    display: flex;
                    padding: 0;
                    margin: 0;
                    margin-left: 10px;
                    line-height: 50px;
                    color: #1da877;
                    font-size: 23px;
                "> Street English Academy </h1>
            </header>
    
            @yield('content')
    
            <footer style="
                margin-top: 50px;
            ">
                <div>
                    <span>Thanks,</span><br>
                    <span><b>{{ env('APP_NAME') }}</b>.</span>
                </div>
    
                <div style="text-align: center; margin-top: 25px">
                    Developed by <a href="https://www.github.com/abdullahessamm"> Abdullah Essam </a>
                </div>
    
            </footer>
    
        </section>
    </div>

</body>
</html>
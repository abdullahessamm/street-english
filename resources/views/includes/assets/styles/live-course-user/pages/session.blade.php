<link href="https://unpkg.com/survey-core@1.9.34/defaultV2.min.css" type="text/css" rel="stylesheet"/>
<link href="https://unpkg.com/survey-creator-core@1.9.34/survey-creator-core.min.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/wizard.css') }}">
<style>
    a[href*=previous],
    a[href*=finish],
    a[href*=next]{
        margin-top: 20px;
        font-size: 20px;
        padding: 15px;
    }

    a[href*=previous],
    a[href*=next]{
        background: #18a674;
        color: #ffffff;
    }

    a[href*=previous]{
        float: left;
    }

    a[href*=finish],
    a[href*=next]{
        float: right;
    }

    a[href*=finish]{
        background: red;
        color: #ffffff;
    }
</style>
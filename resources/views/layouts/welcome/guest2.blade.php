<style>
    .logo {
        position: absolute;
        bottom: 0px;
        right: 150px;
        top: -105px;
        font-size: 18px;
    }

    .button-64 {
        position: absolute;
        top: 175%;
        left: 45%;
        align-items: center;
        background-image: linear-gradient(144deg, #AF40FF, #5B42F3 50%, #00DDEB);
        border: 0;
        border-radius: 8px;
        box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
        box-sizing: border-box;
        color: #FFFFFF;
        display: flex;
        font-family: Phantomsans, sans-serif;
        font-size: 20px;
        justify-content: center;
        line-height: 1em;
        max-width: 100%;
        min-width: 140px;
        padding: 3px;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        cursor: pointer;
    }

    .button-64:active,
    .button-64:hover {
        outline: 0;
    }

    .button-64 span {
        background-color: rgb(5, 6, 45);
        padding: 16px 24px;
        border-radius: 6px;
        width: 100%;
        height: 100%;
        transition: 300ms;
    }

    .button-64:hover span {
        background: none;
    }

    @media (min-width: 768px) {
        .button-64 {
            font-size: 24px;
            min-width: 196px;
        }
    }
</style>

<div style="text-align: center;">
    <a href="{{ route('login') }}"><button class="button-64" role="button"><span class="text">Login</span></button></a>
</div>


<div>
    <a href="{{ route('home') }}">
        <img class="logo" src="{{ asset('assets') }}/img/brand/favicon.png" width="110px" />
    </a>
</div>
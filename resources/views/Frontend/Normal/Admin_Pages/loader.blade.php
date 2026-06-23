<style>
    #ktr-erp-loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: #0a0818;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
        /* Sabse upar dikhega */
        opacity: 1;
        visibility: visible;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    #ktr-erp-loader-overlay.ktr-hide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .loader-container {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ktr-title {
        color: #d1d1f0;
        font-size: 3rem;
        font-weight: bold;
        letter-spacing: 5px;
        text-transform: uppercase;
        margin-bottom: 5px;
        text-shadow: 0 0 15px rgba(209, 209, 240, 0.6);
    }

    .ktr-tagline {
        color: #a2a2c7;
        font-size: 1rem;
        letter-spacing: 2px;
        margin-bottom: 50px;
    }

    .logo-wrapper {
        position: relative;
        width: 180px;
        height: 180px;
        margin-bottom: 60px;
    }

    .halo-ring {
        position: absolute;
        top: 10%;
        left: 10%;
        width: 80%;
        height: 80%;
        border: 4px solid #7146ce;
        border-radius: 50%;
        box-shadow: 0 0 40px #7146ce;
        animation: pulseHalo 2s infinite ease-in-out;
    }

    .loop-figure {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 15px solid #4a2893;
        border-bottom: 15px solid transparent;
        border-radius: 50%;
        transform: rotate(-30deg);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3), inset 0 0 20px #8e61e6, 0 0 30px #7146ce;
        animation: spinLoop 5s linear infinite;
    }

    .loop-figure::before,
    .loop-figure::after {
        content: "";
        position: absolute;
        border: 2px solid #a2a2c7;
        border-radius: 50%;
        opacity: 0.5;
    }

    .loop-figure::before {
        top: 20%;
        left: 20%;
        width: 60%;
        height: 60%;
        border-top: 2px solid transparent;
    }

    .loop-figure::after {
        top: 30%;
        left: 30%;
        width: 40%;
        height: 40%;
        border-right: 2px solid transparent;
    }

    .bottom-halo {
        position: absolute;
        bottom: -35px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        border: 3px solid #7146ce;
        border-radius: 50%;
        box-shadow: 0 0 20px #7146ce;
        animation: pulseHalo 2s infinite ease-in-out;
    }

    .progress-bar {
        display: flex;
        flex-direction: row
        justify-content: center;
        gap: 15px;
    padding:15px;
    }

    .dot {
        width: 12px;
        height: 12px;
        background-color: #d1d1f0;
        border-radius: 50%;
        box-shadow: 0 0 10px #d1d1f0;
        animation: dotFade 1.4s infinite ease-in-out;
    }

    .dot:nth-child(1) {
        animation-delay: 0s;
    }

    .dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    .dot:nth-child(4) {
        animation-delay: 0.6s;
    }

    .dot:nth-child(5) {
        animation-delay: 0.8s;
    }

    .dot:nth-child(6) {
        animation-delay: 1s;
    }

    .dot:nth-child(7) {
        animation-delay: 1.2s;
    }

    @keyframes spinLoop {
        0% {
            transform: rotate(-30deg);
        }

        100% {
            transform: rotate(330deg);
        }
    }

    @keyframes pulseHalo {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
            box-shadow: 0 0 40px #7146ce;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.8;
            box-shadow: 0 0 60px #7146ce;
        }
    }

    @keyframes dotFade {

        0%,
        100% {
            opacity: 0.3;
            transform: scale(0.8);
        }

        50% {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<div id="ktr-erp-loader-overlay">
    <div class="loader-container">
        <div class="ktr-title">KTR ERP</div>
        <div class="ktr-tagline">CONNECTING YOUR WORLD...</div>

        <div class="logo-wrapper">
            <div class="halo-ring"></div>
            <div class="loop-figure"></div>
            <div class="bottom-halo"></div>
        </div>

        <div class="progress-bar">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</div>


<script>
    function KTR_ERP_API_LOADER(show) {
        const overlay = document.getElementById("ktr-erp-loader-overlay");
        if (!overlay) return;
        if (show) {
            overlay.classList.remove("ktr-hide");
        } else {
            overlay.classList.add("ktr-hide");
        }
    }

    async function checkActualInternet() {
        if (!navigator.onLine) {
            KTR_ERP_API_LOADER(true);
            return;
        }
        try {
            await fetch("http://www.msftconnecttest.com/connecttest.txt", {
                method: "HEAD",
                mode: "no-cors",
                cache: "no-store",
            });
            KTR_ERP_API_LOADER(false);
        } catch (error) {
            KTR_ERP_API_LOADER(true);
        }
    }

    window.addEventListener("online", checkActualInternet);
    window.addEventListener("offline", () => KTR_ERP_API_LOADER(true));
    setInterval(checkActualInternet, 5000);

    document.addEventListener("DOMContentLoaded", () => {
        checkActualInternet();
        setTimeout(() => {
            if (navigator.onLine) {
                checkActualInternet();
            }
        }, 3000);
    });
</script>
{{-- <script>
   
    let isInitialBoot = true;

    function KTR_ERP_API_LOADER(show) {
        const overlay = document.getElementById("ktr-erp-loader-overlay");
        if (!overlay) return;

        if (show) {
            overlay.classList.remove("ktr-hide");
        } else {
            overlay.classList.add("ktr-hide");
        }
    }

    function checkActualInternet() {
       
        if (isInitialBoot) return;

        if (navigator.onLine) {
            KTR_ERP_API_LOADER(false);
        } else {
            KTR_ERP_API_LOADER(true); 
        }
    }


    window.addEventListener("online", checkActualInternet);
    window.addEventListener("offline", () => KTR_ERP_API_LOADER(true));


    setInterval(() => {
        if (!isInitialBoot) {
            checkActualInternet();
        }
    }, 10000);

  
    document.addEventListener("DOMContentLoaded", () => {
       
        KTR_ERP_API_LOADER(true);

        setTimeout(() => {
            isInitialBoot = false; 

            if (navigator.onLine) {
                KTR_ERP_API_LOADER(false); 
            } else {
                KTR_ERP_API_LOADER(true); 
            }
        }, 3000);
    });
</script> --}}

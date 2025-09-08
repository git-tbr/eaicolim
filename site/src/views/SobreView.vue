<template>
    <NavbarComponent />
    <FloatBtnComponent />
    <main class="bg-elipse">
        <div class="container-fluid">
            <div class="row bg-ribbom py-5">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="text-light py-3">
                                    Quem é Alexandre Colim?
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-3">
            <div class="row">
                <div class="col-xl-6 text-darkblue mb-3 mb-xl-0">
                    <p class="text-justify mb-1">
                        <b>Alexandre Colim</b> tem mais de <b>24 anos de estrada no jornalismo</b>. Começou no rádio, no
                        comecinho dos
                        anos 2000, e nunca mais largou o microfone. Logo de cara, vale dizer: ele é <b>apaixonado por
                            contar histórias</b>.
                    </p>
                    <p class="text-justify mb-1">
                        <b>Colim</b>, como prefere ser chamado, foi <b>forjado nas ruas</b>, no ritmo intenso do
                        <b>jornalismo diário</b>. As histórias que viveu e contou ao longo da carreira ajudaram a moldar
                        <b>não só o profissional, mas também o ser humano</b>. Por isso, não estranhe se ele <b>se
                            emocionar com um tema sensível</b> ou se <b>indignar com alguma injustiça</b>, tudo isso
                        pode acontecer no intervalo de poucos segundos. E é isso que o torna tão <b>genuíno</b>.
                    </p>
                    <p class="text-justify mb-1">
                        Com o tempo, Colim desenvolveu habilidades que hoje fazem parte do seu estilo: <b>improviso,
                            rapidez de raciocínio</b> e uma capacidade única de <b>adaptação</b>. Na <b>Record
                            Paulista</b>, ele transita entre o <b>agro</b>, o <b>esporte</b>, o <b>hard news</b> e o
                        <b>Balanço Geral</b>. É <b>apresentador, repórter, contador de histórias</b>, sempre com o mesmo
                        brilho no olhar.
                    </p>
                    <p class="text-justify mb-1">
                        No rádio, vive o dia a dia intenso do <b>hard news</b>. Na TV, conta histórias nas mais diversas
                        linguagens. E no podcast, une tudo isso com <b>liberdade e personalidade</b>. Fala com todo
                        mundo: o <b>jogador</b>, o <b>agricultor</b>, o <b>empresário</b>, o <b>juiz</b>, o <b>povão</b>
                        e até o <b>criminoso</b>. Ele entra na história antes de contá-la e isso faz toda a diferença.
                    </p>
                    <p class="text-justify mb-1">
                        Agora, toda essa trajetória se transforma em um novo espaço: um podcast com o DNA do Colim.
                        Entre a seriedade e a leveza, a informação e o entretenimento, ele segue fazendo o que ama — do
                        jeito que só ele sabe fazer.
                    </p>
                    <p class="text-justify mb-1">
                        <b>Curta, acompanhe e consuma sem moderação. Bem-vindo ao “E aí, Colim?”.</b>
                    </p>
                </div>
                <div class="col-10 col-md-8 col-xl-6 position-relative mx-auto">
                    <img src="../assets/img/alexandre_colim.png" alt="Alexandre Colim" class="img-floating">
                    <img src="../assets/img/light-blue_microphone.png" alt="microfone" class="floating-microphone-one">
                    <img src="../assets/img/light-blue_microphone.png" alt="microfone" class="floating-microphone-two">
                    <!-- <img src="../assets/img/elipse.png" alt="elipse" class="floating-elipse"> -->
                </div>
            </div>
        </div>
    </main>
    <FooterSiteComponent />
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterSiteComponent from '@/components/FooterSiteComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import FloatBtnComponent from '@/components/FloatBtnComponent.vue';
</script>

<style scoped>
.text-darkblue {
    color: #143160;
}

.bg-ribbom {
    background-image: url(../assets/img/ribbom.png);
    background-position: bottom left;
    background-size: cover;
}

.img-floating {
    position: relative;
    z-index: 3;
    width: 90%;
    margin-left: auto;
    margin-right: auto;
}

.floating-microphone-one {
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 2;
    width: 40%;
}

.floating-microphone-two {
    position: absolute;
    left: 0;
    right: 20px;
    z-index: 2;
    width: 40%;
    transform: rotateY(180deg);
}

/* .floating-elipse {
    position: absolute;
    top: -50%;
    right: -55%;
    width: 100%;
    z-index: -1;
} */

.bg-elipse {
    background-image: url(../assets/img/elipse.png);
    background-position: top right;
    background-size: auto;
    background-repeat: no-repeat;
    background-position-y: -100%;
    background-position-x: -100%;
}

@media screen and (min-width: 1200px) {
    .img-floating {
        margin-top: 1%;
    }

    .floating-microphone-one {
        bottom: 5%;
    }

    .floating-elipse {
        margin-top: -30%;
    }

    .bg-elipse {
        background-image: url(../assets/img/elipse.png);
        background-position: top right;
        background-size: auto;
        background-repeat: no-repeat;
        background-position-y: -50%;
    }
}

@media screen and (min-width: 1400px) {
    .img-floating {
        margin-top: -30%;
    }

    .floating-microphone-one {
        bottom: 10%;
    }

    .floating-elipse {
        margin-top: -30%;
    }
}
</style>
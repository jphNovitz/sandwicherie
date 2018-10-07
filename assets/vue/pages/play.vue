<template>
    <div>
        <div class="ui container">
            <div class="ui grid">
                <sui-grid-column :width="6">
                    <div class="ui message" v-if="!player_1_continue && !player_2_continue">
                        <div class="header">
                            Partie terminée
                        </div>
                    </div>

                    <div id="p_1">
                        <h2>Joueur 1: {{player_1.points}}</h2>
                        <sui-list horizontal>
                            <sui-list-item class="card" v-for="card in player_1.cards">
                                {{card.figure}} {{card.family}}
                            </sui-list-item>
                        </sui-list>
                    </div>
                </sui-grid-column>

                <sui-grid-column :width="4">
                    <button class="ui positive button" type="button" @click="play(player_1)" v-show="altern"
                            v-if="player_1_continue"> Jouer
                    </button>
                    <button class="ui negative button" type="button" @click="play(player_2)" v-show="!altern"
                            v-if="player_2_continue"> Jouer
                    </button>
                </sui-grid-column>

                <sui-grid-column :width="6">
                    <div id="p_2">
                        <h2>Joueur 1: {{player_1.points}}</h2>
                        <sui-list horizontal>
                            <sui-list-item class="card" v-for="card in player_2.cards">
                                {{card.figure}} {{card.family}}
                            </sui-list-item>
                        </sui-list>

                    </div>
                </sui-grid-column>
            </div>
        </div>


    </div>
</template>

<script>

    export default {
        name: 'play',
        components: {},
        data() {
            return {
                altern: true,
                cards: [],
                family: ['trefle', 'pique', 'coeur', 'carreau'],
                figures: ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Q', 'V', 'K', 'A'],
                player_1: {
                    cards: [],
                    pending: [],
                    points: 0,
                    encore: true
                },
                player_2: {
                    cards: [],
                    pending: [],
                    points: 0,
                    encore: true
                }
            }
        },
        methods: {
            initialize: function () {
                this.figures.map(fig => {
                        for (let i = 0; i < 4; i++) {
                            let tempCard = {
                                'family': this.family[i],
                                'figure': fig,
                                'value': this.figures.indexOf(fig)
                            }
                            this.cards.push(tempCard)
                        }
                    }
                )
            },
            giveCardToPlayer: function (player) {
                let randomCard = this.cards[Math.floor(Math.random() * this.cards.length)]
                let cardPosition = this.cards.indexOf(randomCard)
                player.pending.push(randomCard)
                this.cards.splice(cardPosition, 1)
            },
            distribute: function () {
                while (this.cards.length > 0) {
                    this.giveCardToPlayer(this.player_1)  // card to player 1
                    this.giveCardToPlayer(this.player_2)  // card to player 2
                }
            },
            pickCard: function (player) {
                let card = player.pending[0]
                player.pending.splice(0, 1)
                return card
            },
            play: function (player) {
                this.altern = !this.altern
                const card = this.pickCard(player)
                player.points += card.value
                player.cards.push(card)

            }
        },
        mounted() {
            this.initialize()
            this.distribute()

        },
        computed: {
            player_1_continue: function () {
                if (this.player_1.pending.length > 0) {
                    return true
                } else {
                    return false
                }
            },
            player_2_continue: function () {
                if (this.player_1.pending.length > 0) {
                    return true
                } else {
                    return false
                }
            }
        }
    }

</script>
<style scoped>
    .global {
        min-height: 80vh;
        height: 80vh;
    }

    .card {
        /*display: inline-block;*/
        width: 4rem;
        height: 7rem;
        border: solid 1px #000;
        margin: 1rem;
    }
</style>
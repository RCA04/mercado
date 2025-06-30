pipeline{

    agent any

    stages{

        stage('pegando repositorios'){
            steps{
                sh 'git clone https://github.com/Laradock/laradock.git'
            }
        }

        stage('configurando o laradock'){
            steps{
                dir('laradcok')
                sh 'mv .env.example .env'
            }
        }

        stage('Montando Imagem docker'){
            steps{
                    dir('laradock') {
                    sh 'docker compose build workspace'
                    }
            }
        }
        stage('Ativando imagem docker'){
            steps{
                    dir('laradock'){
                    sh 'docker compose up -d nginx mysql workspace'
                    }
            }
        }

        stage('Composer install'){
            steps{                
                    dir('laradock'){
                    sh 'docker compose exec workspace composer install'
                    }
            }
        }

        stage('Run migrations') {
            steps {
                dir('laradock') {
                    sh 'docker compose exec workspace php artisan migrate'
                }
            }
        }

        stage('Ativando aplicação'){
            steps{
                    dir('laradock'){
                        sh 'docker compose exec workspace php artisan test'
                    }
            }
        }
    }    
}

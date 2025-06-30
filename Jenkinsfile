pipeline{

    agent any

    stages{

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

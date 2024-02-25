pipeline {
    agent any
 
        stages {
        stage('Cloning Git') {
            steps {
                git branch: 'main', url: 'https://github.com/santoshbd67/phpapp.git' 
            }
        }
        
        // Building Docker images
        stage('Building image') {
            steps {
                script {
                        sh "aws ecr-public get-login-password --region us-east-1 | docker login --username AWS --password-stdin public.ecr.aws/r7u8p7a8"
                        sh "docker build -t phpappapplication ."
                        sh "docker tag phpappapplication:latest public.ecr.aws/r7u8p7a8/phpappapplication:latest"
                        sh "docker push public.ecr.aws/r7u8p7a8/phpappapplication:latest"
                }
            }
        }
    }
}

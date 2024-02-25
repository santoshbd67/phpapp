pipeline {
    agent any
    environment {
        AWS_DEFAULT_REGION = "us-east-1" 
        IMAGE_REPO_NAME = "phpappapplication"
        IMAGE_TAG = "latest"
         REPOSITORY_URI = "public.ecr.aws/r7u8p7a8/${IMAGE_REPO_NAME}"
    }
    
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
                    dockerImage = docker.build "${IMAGE_REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }

        // Pushing Docker images to AWS ECR
        stage('Push to ECR') {
            steps {
                script {
                    // Tag the Docker image
                    sh "docker tag phpappapplication:latest public.ecr.aws/r7u8p7a8/phpappapplication:latest"

                    // Push the Docker image to ECR
                    sh "docker push public.ecr.aws/r7u8p7a8/phpappapplication:latest"
                }
            }
        }
    }
}

pipeline {
    agent any
    environment {
        AWS_DEFAULT_REGION="us-east-1" 
        IMAGE_REPO_NAME="phpapppubapp"
        IMAGE_TAG="latest"
        REPOSITORY_URI = "${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${IMAGE_REPO_NAME}"
        AWS_ACCESS_KEY_ID     = credentials('accesskey')
        AWS_SECRET_ACCESS_KEY = credentials('secretkey')
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

        // Uploading Docker images into AWS ECR
        stage('Push to ECR') {
            steps {
                script {
                    // Build Docker image locally
                    def dockerImage = docker.build "${IMAGE_REPO_NAME}:${IMAGE_TAG}"

                    // Debug statement
                    echo "Docker image built: ${dockerImage}"

                    // Tag the Docker image
                    sh "docker tag ${IMAGE_REPO_NAME}:${IMAGE_TAG} public.ecr.aws/b1u8y4d2/${IMAGE_REPO_NAME}:${IMAGE_TAG}"

                    // Debug statement
                    sh "docker images" // Check images after tagging

                    // Push the Docker image to ECR
                    sh "docker push public.ecr.aws/b1u8y4d2/${IMAGE_REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }
    }
}

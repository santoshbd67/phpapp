pipeline {
    agent any

    environment {
        // AWS credentials configured in Jenkins Credentials
        AWS_ACCESS_KEY_ID     = credentials('access_id')
        AWS_SECRET_ACCESS_KEY = credentials('secret_id')
        AWS_REGION            = 'us-east-1'
        ECR_REGISTRY          = 'public.ecr.aws/t0x2d0e3/phpapp'
        IMAGE_NAME            = 'phpwebapp'
    }

    stages {
        stage('Checkout') {
            steps {
              git branch: 'main', url: 'https://github.com/santoshbd67/phpapp.git'
            }
        }

        stage('Build and Push Docker Image') {
            steps {
                script {
                    // Authenticate with AWS ECR
                    withCredentials([[$class: 'AmazonWebServicesCredentialsBinding', accessKeyVariable: 'AWS_ACCESS_KEY_ID', secretKeyVariable: 'AWS_SECRET_ACCESS_KEY', credentialsId: 'your-aws-credentials-id']]) {
                        docker.withRegistry(ECR_REGISTRY, 'ecr') {
                            // Build Docker image
                            def customImage = docker.build("${ECR_REGISTRY}/${IMAGE_NAME}:${env.BUILD_ID}")

                            // Push Docker image to AWS ECR
                            customImage.push()
                        }
                    }
                }
            }
        }
    }
}

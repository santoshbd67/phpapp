pipeline {
    agent any
    environment {
        AWS_ACCOUNT_ID = "159012065560"
        AWS_DEFAULT_REGION = "us-east-1"
        IMAGE_REPO_NAME = "phpapplication"
        IMAGE_TAG = "latest"
        AWS_CREDENTIALS_ID = "aws_id"
        JENKINS_CREDENTIALS_ID = "ssh_cred"
        REPOSITORY_URI = "${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${IMAGE_REPO_NAME}"
        EC2_INSTANCE_IP = '54.152.22.213'  // Replace with your EC2 instance's IP or DNS
        
    }

    stages {
        stage('Logging into AWS ECR') {
            steps {
                script {
                    sh "aws ecr get-login-password --region ${AWS_DEFAULT_REGION} | docker login --username AWS --password-stdin ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com"
                }
            }
        }

        stage('Cloning Git') {
            steps {
                git branch: 'main', url: 'https://github.com/santoshbd67/phpapp.git'
            }
        }

        stage('Building image') {
            steps {
                script {
                    dockerImage = docker.build "${IMAGE_REPO_NAME}:${IMAGE_TAG}"
                }
            }
        }

        stage('Pushing to ECR') {
            steps {
                script {
                    sh "docker tag ${IMAGE_REPO_NAME}:${IMAGE_TAG} ${REPOSITORY_URI}:${IMAGE_TAG}"
                    sh "docker push ${REPOSITORY_URI}:${IMAGE_TAG}"
                }
            }
        }

  stage('Deploying to EC2') {
    steps {
        script {
            withCredentials([sshUserPrivateKey(credentialsId: JENKINS_CREDENTIALS_ID, keyFileVariable: 'SSH_KEY')]) {
                sh "scp -o StrictHostKeyChecking=no -i ${SSH_KEY} deploy_script.sh ubuntu@${EC2_INSTANCE_IP}:~/"
                sh "ssh -o StrictHostKeyChecking=no -i ${SSH_KEY} ubuntu@${EC2_INSTANCE_IP} 'bash -s' < ~/deploy_script.sh"
            }
        }
    }
}

    }
}

#!/bin/bash

aws ecr get-login-password --region ${AWS_DEFAULT_REGION} | docker login --username AWS --password-stdin ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com
docker stop ${IMAGE_REPO_NAME} || true
docker rm ${IMAGE_REPO_NAME} || true
docker pull ${REPOSITORY_URI}:${IMAGE_TAG}
docker run -d -p 80:80 --name ${IMAGE_REPO_NAME} ${REPOSITORY_URI}:${IMAGE_TAG}

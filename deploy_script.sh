#!/bin/bash
sudo docker pull ${REPOSITORY_URI}:${IMAGE_TAG}
sudo docker stop ${IMAGE_REPO_NAME} || true
sudo docker rm ${IMAGE_REPO_NAME} || true
sudo docker run -d -p 8080:80 --name ${IMAGE_REPO_NAME} ${REPOSITORY_URI}:${IMAGE_TAG}

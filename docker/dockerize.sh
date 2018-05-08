#!/bin/bash
cd ./..
sudo docker run --name=ManageYourAirport --rm -it --net=host -v $(pwd):/ManageYourAirport riera90/symfony-dev:extended

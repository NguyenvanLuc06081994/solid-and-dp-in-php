<?php

namespace CommandBus;

class CreateProductCommandFactory
{
        public static function make(CreateProductRequest $request): CreateProductCommand
        {
                $command = new CreateProductCommand();
                $command->setName($request->get('name'));

                return $command;
        }
}
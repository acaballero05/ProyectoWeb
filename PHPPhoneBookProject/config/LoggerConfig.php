<?php
/* append true agrega, append false sobreescribe al log */
require_once 'vendor/log4php/php/Logger.php';

$logConfigArray = array (
		'appenders' => array (
				'default' => array (
						'class' => 'LoggerAppenderFile',
						'level' => 'warn',
						'layout' => array (
								'class' => 'LoggerLayoutSimple'
						),
						'params' => array (
								'file' => 'log/logger.log',
								'append' => false
						)
				)
		),
		'rootLogger' => array (
				'appenders' => array (
						'default'
				)
		)
);
// Se configura con el arreglo el logger
Logger::configure ( $logConfigArray );


/* Ejemplos de logger*/
#$log->trace("My first message.");   // Not logged because TRACE < WARN
#$log->debug("My second message.");  // Not logged because DEBUG < WARN
#$log->info("My third message.");    // Not logged because INFO < WARN
#$log->warn("My fourth message.");   // Logged because WARN >= WARN
#$log->error("My fifth message.");   // Logged because ERROR >= WARN
?>
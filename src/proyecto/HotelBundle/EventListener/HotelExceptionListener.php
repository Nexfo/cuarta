<?php
namespace proyecto\HotelBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HotelExceptionListener
{
	protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
		
		/* =================================================== */
		$mensaje = ''; $titulo = '';
		
		switch ($exception->getStatusCode()) {
			case 404:
				$mensaje = 'Error (' . $exception->getStatusCode() . '), página no encontrada.';
				$titulo = 'Página no encontrada';
				break;
			case 500:
				$mensaje = 'Ha ocurrido un error al procesar tu petición. Inténtalo de nuevo más tarde.';
				$titulo = 'Error interno del servidor';
				break;
			default:
				$titulo = 'Ha ocurrido un error';
				$mensaje = $titulo . '. Código (' . $exception->getStatusCode() . ')';
		}
		
		$plantilla = $this->twig->render('proyectoHotelBundle:Errores:errores.html.twig',
			array('titulo' => $titulo,
			'mensaje' => $mensaje,
		));
		/* =================================================== */
		
        $response = new Response();
        $response->setContent($plantilla);

        // HttpExceptionInterface es un tipo de excepción especial
        // que permite especificar el estado y las cabeceras
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
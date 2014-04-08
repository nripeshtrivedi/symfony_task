<?php
namespace Acme\TaskBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Acme\TaskBundle\Entity\User;
use Acme\TaskBundle\Entity\Questionstore;
use Symfony\Component\HttpFoundation\Request;
use Acme\TaskBundle\Form\Type\UserType;
use Acme\TaskBundle\Entity\Questionaire;


class DefaultController extends Controller
{
 public function loginAction(Request $request)// Authenticating the user
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'AcmeTaskBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
    public function newAction(Request $request) // Registering the user
    {
	    $message="";
		$user = new User();
		$form = $this->createForm(new UserType(), $user);
		$em = $this->getDoctrine()->getManager();
		$form->handleRequest($request);
		if ($form->isValid()) // Checking form validity
			{	
				$user = $form->getData();
				$repository = $this->getDoctrine()
	            ->getRepository('AcmeTaskBundle:User');
	            $users = $repository->findAll();
				foreach ($users as $USER) // Checking if the user has already registered
				{
				  if($USER->equals($user->getEmail()))
				  {
				  $message="User with this email already exists, Please enter a differet email";
				  return $this->render('AcmeTaskBundle:Default:index.html.twig', array('message'=>$message,
				 'form' => $form->createView()));
    
				  }
				}
				$user->setQuestionaire("yes");
	            $user->setIsActive(true);
				$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);
				$user->setUsername($user->getEmail());
			    $em->persist($user);
				$em->flush();
				$message="Registration successful, Please login by clicking on the link below";
			}
			return $this->render('AcmeTaskBundle:Default:index.html.twig', array('message'=>$message,
			'form' => $form->createView()));
    
}
	public function loggedinAction(Request $request)// redirecting the user after login based on the choice
	{
	    $user = $this->container->get('security.context')->getToken()->getUser();
		$User = $this->getDoctrine()->getRepository('AcmeTaskBundle:User')->find($user);
		$answer=$User->getQuestionaire();
		if($answer=="no") // Checks if the user has made a choice not to answer or already taken the survey, In 
		{
			return $this->render('AcmeTaskBundle:Default:home.html.twig');
		}
		else
		{
			return $this->render('AcmeTaskBundle:Default:answer.html.twig');
		}
	
    }
	  public function showAction(Request $request)// Loads the question in database in first time execution and redirects the user to survey
    {

	   $repository = $this->getDoctrine()
	   ->getRepository('AcmeTaskBundle:questionstore');
	   $Questionstore = $repository->findAll();
	   if($Questionstore==null)
		{
			$Questionstore = new Questionstore();
			$Questionstore->setQName("Which type of occupation describes you best ?");
			$Questionstore->setOption1("pupil");
			$Questionstore->setOption2("student");
			$Questionstore->setOption3("employee");
			$Questionstore->setOption4("civil servant");
			$Questionstore->setOption5("self employed");
			$Questionstore->setOption6("other");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore);
			$em->flush();
			$Questionstore1 = new Questionstore();
			$Questionstore1->setQName("How often do you visit our website");
			$Questionstore1->setOption1("1-3 times");
			$Questionstore1->setOption2("3-5 times");
			$Questionstore1->setOption3("more than 5 times");
			$Questionstore1->setOption4("");
			$Questionstore1->setOption5("");
			$Questionstore1->setOption6("");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore1);
			$em->flush();
			$Questionstore2 = new Questionstore();
			$Questionstore2->setQName("In which of our website's topics are you mostly interested in ?");
			$Questionstore2->setOption1("politics");
			$Questionstore2->setOption2("culture");
			$Questionstore2->setOption3("sports");
			$Questionstore2->setOption4("people");
			$Questionstore2->setOption5("business");
			$Questionstore2->setOption6("");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore2);
			$em->flush();
			$Questionstore3 = new Questionstore();
			$Questionstore3->setQName("Which other topics would you like to find on our website? ");
			$Questionstore3->setOption1("music");
			$Questionstore3->setOption2("internet");
			$Questionstore3->setOption3("local");
			$Questionstore3->setOption4("travel");
			$Questionstore3->setOption5("cars");
			$Questionstore3->setOption6("");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore3);
			$em->flush();
			$Questionstore4 = new Questionstore();
			$Questionstore4->setQName("Are there any other people living with You?");
			$Questionstore4->setOption1("yes");
			$Questionstore4->setOption2("no");
			$Questionstore4->setOption3("I'm living with my parents");
			$Questionstore4->setOption4("I'm living in a flat share community");
			$Questionstore4->setOption5("I'm living with a partner");
			$Questionstore4->setOption6("");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore4);
			$em->flush();
			$Questionstore5 = new Questionstore();
			$Questionstore5->setQName("How old are you?");
			$Questionstore5->setOption1("below 18");
			$Questionstore5->setOption2("18 – 25");
			$Questionstore5->setOption3("25 – 32");
			$Questionstore5->setOption4("32 – 40");
			$Questionstore5->setOption5("41 – 50");
			$Questionstore5->setOption6("over 50");
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionstore5);
			$em->flush();
		
		}
	
		$questions = $repository->findAll(); // Displaying all the questions after storing in 4questions and passing to the template
		$user = $this->container->get('security.context')->getToken()->getUser();
		$User = $this->getDoctrine()->getRepository('AcmeTaskBundle:User')->find($user);
		$answer=$User->setQuestionaire("no");
		$em = $this->getDoctrine()->getManager();
        $em->persist($User);
        $em->flush();
		if($questions!=null)
		{
			return $this->render('AcmeTaskBundle:Default:question.html.twig', array(
			'questions'=>$questions,));
		}
			 
   }
 public function processAction(Request $request)// processes the answers and redirects accordingly
   {
	 $error="";
	 $data=$request->request->all();
	 $repository = $this->getDoctrine()
	 ->getRepository('AcmeTaskBundle:Questionstore');
	 $questions = $repository->findAll();
	 $Questionaire=new Questionaire();
	 $session = $this->getRequest()->getSession();
	 if((@$data['q1']!=null)&&(@$data['q2']!=null)&&(@$data['q3']!=null)) // Checking for the validity of answers on first page
	  {
	  
	    $user = $this->container->get('security.context')->getToken()->getUser();
		$User = $this->getDoctrine()->getRepository('AcmeTaskBundle:User')->find($user);
		$Questionaire->setUid($User);
		if((@$data['other']!=null)&&(@$data['q1']=="other")) // Checking for the validity of answer in question 1
		{
			$Questionaire->setQ1($data['other']);
		}
		else if((@$data['other']==null)&&(@$data['q1']!=null)&&(@$data['q1']!="other"))
		{
			$Questionaire->setQ1($data['q1']);
		}
		else
		{
			if((@$data['q1']=="other") && (@$data['other']==null))
		{
			$error="Please specify the other choice in text box";	
			return $this->render('AcmeTaskBundle:Default:question.html.twig', array(
			'questions'=>$questions,'error'=>$error,));
        }		  
	  }
		$Questionaire->setQ2($data['q2']);
		$q3 = implode(',', $data['q3']);
		$Questionaire->setQ3($q3);
		$session->set("answers",$Questionaire);
	  
	    return $this->render('AcmeTaskBundle:Default:question1.html.twig', array(
		'questions'=>$questions,));
	 }
	  else if((@$data['q4']!=null)&&(@$data['q5']!=null)&&(@$data['q6']!=null)) //Checking for the validity of answers on second page
	 {
	    $Questionaire=$session->get("answers",null);
	    $q4 = implode(',', $data['q4']);
		$Questionaire->setQ4($q4);
		if(@$data['q5']=="yes") //Checking for the validity of answer in question 5
		{
			if(@$data['yes']==null)
			{
				$error=" Please specify your choice yes in question 2";
				return $this->render('AcmeTaskBundle:Default:question1.html.twig', array(
				'questions'=>$questions,'error'=>$error,));
			}
			$q5[]=$data['q5'];
			$q5[]=$data['yes'];
			$q5 = implode(',', $q5);
			$Questionaire->setQ5($q5);
		}
			else
			{
				$Questionaire->setQ5($data['q5']);
			}
			$Questionaire->setQ6($data['q6']);
			$em = $this->getDoctrine()->getManager();
			$em->persist($Questionaire);
			$em->flush();
			return $this->render('AcmeTaskBundle:Default:home.html.twig');
		}
		 else 
	    {
			$error="Please answer all the questions";
			if(@$data['next']!=null)
			{
				return $this->render('AcmeTaskBundle:Default:question.html.twig', array(
				'questions'=>$questions,'error'=>$error,));
			}
			else
			{
			return $this->render('AcmeTaskBundle:Default:question1.html.twig', array(
			'questions'=>$questions,'error'=>$error,));
			}
	   }
	}
	 public function answerAction(Request $request)// Redirects the user based on whether user wants to take the survey
	  {
	  $error="";
	  $data=$request->request->all();
	  if((@$data['answer']!=null))
	  {
	    $user = $this->container->get('security.context')->getToken()->getUser();
		$User = $this->getDoctrine()->getRepository('AcmeTaskBundle:User')->find($user);
		$User->setQuestionaire($data['answer']);
		if($data['answer']=="yes") // Redirecting to survey through show controller
		{
			return $this->forward('AcmeTaskBundle:Default:show');
		}
		else  // Redirecting to home page
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
			$User = $this->getDoctrine()->getRepository('AcmeTaskBundle:User')->find($user);
			$User->setQuestionaire("no");
			$em = $this->getDoctrine()->getManager();
			$em->persist($User);
			$em->flush();
			return $this->render('AcmeTaskBundle:Default:home.html.twig');
		}
	}
		else // Error-> No Choice Selected
		{
		$error="Please select an option";
		return $this->render('AcmeTaskBundle:Default:answer.html.twig', array(
	    'error'=>$error,));
		}
	}

    public function logoutAction(Request $request) // Logout the user
	{
	@$this->get('security.context')->setToken(null);
	@$this->get('request')->getSession()->invalidate();
	return $this->render('AcmeTaskBundle:Default:login.html.twig');	   
	}
 }



CODING – API FOR GROUP CHAT
a)

Conversation with 1 or more people
b)

Conversation can have title/name
c)

No need to focus on API Auth
REQUIREMENTS
1)

Endpoints
2)

Feature Tests for Endpoint
- list of all conversations that i'm parto of


### models
* conversation 
  * title, name
  * have many users
    
* message
    * body
    * belongs to user
    * belongs to conversation

user

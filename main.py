import pymysql
from app import app
from db_config import mysql
from flask import jsonify
from flask import flash, request
from werkzeug.security import generate_password_hash, check_password_hash


@app.route('/add_user', methods=['POST'])
def add_user():
    try:
        _json = request.json
        _prenom = _json['prenom']
        _mail = _json['mail']
        _mdp = _json['mdp']
        _nom = _json['nom']
        _telephone = _json['telephone']
        _adresse = _json['adresse']
        # validate the received values
        print("toto")
        if _prenom and _mail and _mdp and _telephone and _adresse and _nom and request.method == 'POST':
            # do not save password as a plain text
            _hashed_password = generate_password_hash(_mdp)
            # save edits
            sql = "INSERT INTO users(prenom, mail, mdp, nom, telephone, adresse) VALUES(%s, %s, %s, %s, %s, %s)"
            data = (_prenom, _mail, _hashed_password, _nom, _telephone, _adresse,)
            conn = mysql.connect()
            cursor = conn.cursor(pymysql.cursors.DictCursor)
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('User added successfully!')
            resp.status_code = 200
            return resp
        else:
            return not_found()


    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users')
def users():
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM users")
        rows = cursor.fetchall()
        resp = jsonify(rows)
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users/<int:id>')
def user(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM users WHERE id_user=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()

@app.route('/update_user', methods=['POST'])
def update_user():
    try:
        _json = request.json
        _id = _json['id']
        _name = _json['name']
        _email = _json['email']
        _password = _json['pwd']
        _lastname = _json['lastname']
        _tel = _json['tel']
        _adresse = _json['adresse']
        # validate the received values
        if _name and _email and _password and _id and _tel and _adresse and _lastname and request.method == 'POST':
            # do not save password as a plain text
            _hashed_password = generate_password_hash(_password)
            # save edits
            sql = "UPDATE users SET Prenom=%s, mail=%s, mdp=%s, Nom=%s, telephone=%s, adresse=%s WHERE id_user=%s"
            data = (_name, _email, _hashed_password, _lastname, _tel, _adresse, _id,)
            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('User updated successfully!')
            resp.status_code = 200
            return resp
        else:
            return not_found()
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/delete_user/<int:id>')
def delete_user(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM users WHERE id_user=%s", (id,))
        conn.commit()
        resp = jsonify('User deleted successfully!')
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.errorhandler(404)
def not_found(error=None):
    message = {
        'status': 404,
        'message': 'Not Found: ' + request.url,
    }
    resp = jsonify(message)
    resp.status_code = 404
    return resp




#-----------------------------------------------Stations---------------------------------------------------------------




@app.route('/add_station', methods=['POST'])
def add_station():
    try:
        _json = request.json
        _numero_serie_station = _json['numero_serie_station']
        _date_achat = _json['date_achat']
        _modele = _json['modele']
        _id_user = _json['id_user']
        # validate the received values
        print("toto")
        if _numero_serie_station and _date_achat and _modele and _id_user and request.method == 'POST':
            # save edits
            sql = "INSERT INTO stations(numero_serie_station, date_achat, modele, id_user) VALUES(%s, %s, %s, %s)"
            data = (_numero_serie_station, _date_achat, _modele, _id_user)
            conn = mysql.connect()
            cursor = conn.cursor(pymysql.cursors.DictCursor)
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('Station added successfully!')
            resp.status_code = 200
            return resp
        else:
            return not_found()


    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/stations')
def stations():
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM stations")
        rows = cursor.fetchall()
        resp = jsonify(rows)
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/station/<int:id>')
def station(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM stations WHERE numero_serie_station=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()

@app.route('/station_user/<int:id>')
def station_user(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM stations WHERE id_user=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()

@app.route('/update_station', methods=['POST'])
def update_station():
    try:
        _json = request.json
        _numero_serie_station = _json['numero_serie_station']
        _date_achat = _json['date_achat']
        _modele = _json['modele']
        _id_user = _json['id_user']
        # validate the received values
        if _numero_serie_station and _date_achat and _modele and _id_user and request.method == 'POST':
            # save edits
            sql = "UPDATE stations SET numero_serie_station=%s, date_achat=%s, modele=%s WHERE id_user=%s"
            data = (_numero_serie_station, _date_achat, _modele, _id_user,)
            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('Station updated successfully!')
            resp.status_code = 200
            return resp
        else:
            return not_found()
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()

@app.route('/delete_station/<int:id>')
def delete_station(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM stations WHERE numero_serie_station=%s", (id,))
        conn.commit()
        resp = jsonify('Station deleted successfully!')
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()



#--------------------------------------------------Capteurs-------------------------------------------------------------



@app.route('/add_capteur', methods=['POST'])
def add_capteur():
    try:
        _json = request.json
        _numero_serie_capteur = _json['numero_serie_capteur']
        _emplacement = _json['emplacement']
        _numero_serie_station = _json['numero_serie_station']
        # validate the received values
        print("toto")
        if _numero_serie_capteur and _emplacement and _numero_serie_station and request.method == 'POST':
            # do not save password as a plain text
            sql = "INSERT INTO capteurs(numero_serie_capteur, emplacement, numero_serie_station) VALUES(%s, %s, %s)"
            data = (_numero_serie_capteur, _emplacement, _numero_serie_station)
            conn = mysql.connect()
            cursor = conn.cursor(pymysql.cursors.DictCursor)
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('Capteur ajouté avec succés !')
            resp.status_code = 200
            return resp
        else:
            return not_found()


    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()

@app.route('/capteurs')
def capteurs():
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM capteurs")
        rows = cursor.fetchall()
        resp = jsonify(rows)
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()



@app.route('/capteur/<int:id>')
def capteur(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM capteurs WHERE numero_serie_capteur=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/capteurs_station/<int:id>')
def capteurs_station(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM capteurs WHERE numero_serie_station=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/delete_capteur/<int:id>')
def delete_capteur(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM capteurs WHERE numero_serie_capteur=%s", (id,))
        conn.commit()
        resp = jsonify('Capteur effacé avec succés !')
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()




#--------------------------------------------------Relevés--------------------------------------------------------------


@app.route('/add_releve', methods=['POST'])
def add_releve():
    try:
        _json = request.json
        _temperature = _json['temperature']
        _humidite = _json['humidite']
        _date = _json['date']
        _numero_serie_capteur = _json['numero_serie_capteur']
        # validate the received values
        print("toto")
        if _numero_serie_capteur and _temperature and _humidite and _date and request.method == 'POST':
            # do not save password as a plain text
            sql = "INSERT INTO releves(numero_serie_capteur, temperature, humidite, date) VALUES(%s, %s, %s, %s)"
            data = (_numero_serie_capteur, _humidite, _date, _temperature,)
            conn = mysql.connect()
            cursor = conn.cursor(pymysql.cursors.DictCursor)
            cursor.execute(sql, data)
            conn.commit()
            resp = jsonify('Relevé ajouté avec succés !')
            resp.status_code = 200
            return resp
        else:
            return not_found()


    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/releve/<int:id>')
def releve(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM releves WHERE id_releve=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()



@app.route('/releve_capteur/<int:id>')
def releve_capteur(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM releves WHERE numero_serie_capteur=%s", id)
        row = cursor.fetchall()
        resp = jsonify(row)
        resp.status_code = 200
        print(resp)
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/delete_releve/<int:id>')
def delete_releve(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM releves WHERE id_releve=%s", (id,))
        conn.commit()
        resp = jsonify('Relevé effacé avec succés !')
        resp.status_code = 200
        return resp
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()



if __name__ == "__main__":
    app.run()
